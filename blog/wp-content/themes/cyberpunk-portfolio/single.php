<?php get_header(); ?>

<main class="pt-32 pb-20 section-bg">
    <div class="max-w-4xl mx-auto px-4">
        <?php while (have_posts()) : the_post(); ?>
            <article class="single-post cyberpunk-card">
                <header class="mb-8">
                    <h1 class="font-heading"><?php the_title(); ?></h1>
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
                
                <div class="post-content font-body">
                    <?php the_content(); ?>
                </div>
                
                <footer class="mt-8 pt-8 border-t border-red-500/30">
                    <div class="flex justify-between items-center">
                        <div>
                            <?php if (get_previous_post()) : ?>
                                <a href="<?php echo get_permalink(get_previous_post()); ?>" class="cyberpunk-btn text-sm">
                                    ← Previous Post
                                </a>
                            <?php endif; ?>
                        </div>
                        <div>
                            <a href="/blog" class="cyberpunk-btn text-sm">
                                Back to Blog
                            </a>
                        </div>
                        <div>
                            <?php if (get_next_post()) : ?>
                                <a href="<?php echo get_permalink(get_next_post()); ?>" class="cyberpunk-btn text-sm">
                                    Next Post →
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </footer>
            </article>
            
            <!-- Comments -->
            <?php if (comments_open() || get_comments_number()) : ?>
                <div class="comments-area cyberpunk-card">
                    <?php comments_template(); ?>
                </div>
            <?php endif; ?>
        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?>
