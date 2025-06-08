<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
 


get_header(); ?>

<?php
    ensure_mp_image_loaded(get_the_ID());
    votings_stats(get_the_ID());
    $votings_stats = get_post_meta( get_the_ID(), 'mp_api_voting_stats', true);
?>
<main>
    <h2><?php echo get_field('first_name') . ' ' . get_field('second_name') . ' ' . get_field('last_name'); ?></h2>
    <section>
        <article class='mCard'>
            <?php
                if ( has_post_thumbnail() && get_field('show_image') ) { 
            ?>
            <div class='mpCard__image'>  
                <?php
                    echo the_post_thumbnail( 'medium' );
                ?>
            </div>
            <?php 
                }
            ?>
            <div class='mpCard__info'>
                <p><span>Klub:</span><?php echo get_field('club'); ?></p>
                <p><span>Województwo:</span><?php echo get_field('voivodeship'); ?></p>
                <?php 
                    $state = get_field('active');
                    if($state) {
                        ?>
                        <p><span>Poseł sprawujący mandat</span></p>
                        <?php
                    } else {
                        ?>
                        <p><span>Poseł nie sprawujący mandatu</span></p>
                        <?php
                    }
                ?>
                <p><span>Okrąg:</span><?php echo get_field('district_name'); ?></p>
                <p><span>Liczba głosów:</span><?php echo get_field('district_number'); ?></p>
                <p><span>Zawód:</span><?php echo get_field('profession'); ?></p>
                <p><span>Wyształcenie:</span><?php echo get_field('education_level'); ?></p>
                <p><span>Email:</span><?php echo get_field('email'); ?>
                <p><span>Data urodzin:</span><?php echo get_field('birth_date'); ?>
                <p><span>Miejsce urodzenia:</span><?php echo get_field('birth_location'); ?>
            </div>
        </article>
         <h3>Statystyki głosowań</h3>
            <table>
                <thead>
                    <td>Czy jest usprawiedliwienie nieobecności?`</td>
                    <td>Data posiedzenia</td>
                    <td>Liczba opuszczonych głosowań</td>
                    <td>Liczba oddanych głosów</td>
                    <td>Liczba głosowań w danym dniu</td>
                    <td>Numer posiedzenia</td>
                </thead>
                <tbody>
                <?php
                    $data_label = [
                        'Data posiedzenia',
                        'Liczba opuszczonych głosowań',
                        'Liczba oddanych głosów',
                        'Liczba głosowań w danym dniu',
                        'Numer posiedzenia'
                    ];
                    $data_label_index = 0;
                    foreach ($votings_stats as $item) {
                        echo '<tr>';
                        if (is_object($item)) {
                            $item = (array) $item;
                        }
                        if (is_array($item)) {
                            foreach ($item as $key => $value) {
                                if ($key === 'absenceExcuse') {
                                    echo '<td data-label="Czy jest usprawiedliwienie nieobecności?">' . ($value ? 'tak' : 'nie') . '</td>';
                                }  else {
                                    echo '<td data-label="' . $data_label[$data_label_index] . '">' . esc_html($value) . '</td>';
                                    $data_label_index++;
                                }
                            }
                        } else {
                            echo esc_html($item);
                        }
                        echo '</tr>';
                        $data_label_index = 0;
                    }
                ?>
                </tbody>
            </table>
    </section>
</main> 

<?php get_footer(); ?>