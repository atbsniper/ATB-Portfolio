<?php get_header(); ?>

<main class="pt-32 pb-20 section-bg">
    <div class="max-w-6xl mx-auto px-4">
        <!-- Hero Section -->
        <section class="text-center mb-16">
            <div data-aos="fade-up" data-aos-duration="1000">
                <h1 class="text-5xl md:text-7xl font-bold mb-6 font-heading">
                    <span class="sleek-text">BLOG</span>
                </h1>
                <p class="text-2xl md:text-3xl text-red-500 mb-8 font-exo">
                    Thoughts & Insights
                </p>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto mb-12 font-body">
                    Exploring cybersecurity, development, and emerging technologies through detailed articles and tutorials.
                </p>
            </div>
        </section>

        <!-- Section Divider -->
        <div class="section-divider mb-16"></div>

        <!-- Blog Posts -->
        <div class="grid gap-8">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <article class="blog-post cyberpunk-card">
                        <header>
                            <h2 class="font-heading">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <div class="post-meta font-fira">
                                <span class="text-red-500"><?php echo get_the_date(); ?></span>
                                <span class="mx-2">•</span>
                                <span><?php echo get_the_author(); ?></span>
                                <?php if (has_category()) : ?>
                                    <span class="mx-2">•</span>
                                    <span><?php the_category(', '); ?></span>
                                <?php endif; ?>
                            </div>
                        </header>
                        
                        <div class="post-excerpt font-body">
                            <?php the_excerpt(); ?>
                        </div>
                        
                        <footer>
                            <a href="<?php the_permalink(); ?>" class="read-more">
                                READ MORE →
                            </a>
                        </footer>
                    </article>
                <?php endwhile; ?>
                
                <!-- Pagination -->
                <div class="pagination">
                    <?php
                    echo paginate_links(array(
                        'prev_text' => '← Previous',
                        'next_text' => 'Next →',
                        'class' => 'pagination-link'
                    ));
                    ?>
                </div>
            <?php else : ?>
                <div class="cyberpunk-card p-8 text-center">
                    <h2 class="text-2xl font-heading text-red-500 mb-4">No Posts Found</h2>
                    <p class="text-gray-300 font-body">No blog posts have been published yet.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
