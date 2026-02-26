<?php
// Fallbacks for optional fields
$category = isset($post['category']) ? strtoupper($post['category']) : 'GENERAL';
$thumbnail = isset($post['thumbnail']) ? $post['thumbnail'] : '';
$tags = isset($post['tags']) ? $post['tags'] : [];

// Ensure thumbnail path is absolute or correct relative to the site root
// $baseUrl (e.g., /ardotechnology/blog/) is passed from index.php
// If thumbnail starts with /, use it as is. If relative, prepend correctly.
// For now, trust the JSON has a root-relative path like /ardotechnology/images/...
?>
<div class="bento-card"
    style="padding: 0; display: flex; flex-direction: column; height: 100%; transition: transform 0.3s ease;">
    <!-- Image -->
    <?php if ($thumbnail): ?>
        <div style="height: 240px; overflow: hidden; position: relative;">
            <a href="<?php echo $baseUrl . $post['slug']; ?>" style="display: block; width: 100%; height: 100%;">
                <img src="<?php echo htmlspecialchars($thumbnail); ?>" alt="<?php echo htmlspecialchars($post['title']); ?>"
                    style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;">
            </a>
            <div class="glass-panel"
                style="position: absolute; top: 1rem; left: 1rem; padding: 0.5rem 1rem; border-radius: 99px; background: rgba(255,255,255,0.8);">
                <span class="text-mono-label"
                    style="font-size: 0.7rem; color: var(--ardo-midnight);"><?php echo htmlspecialchars($category); ?></span>
            </div>
        </div>
    <?php endif; ?>

    <div style="padding: 2rem; flex-grow: 1; display: flex; flex-direction: column;">
        <!-- Title -->
        <h3
            style="margin: 0 0 1rem; font-size: 1.5rem; font-weight: 800; line-height: 1.3; color: var(--ardo-midnight);">
            <a href="<?php echo $baseUrl . $post['slug']; ?>" style="text-decoration: none; color: inherit;">
                <?php echo htmlspecialchars($post['title']); ?>
            </a>
        </h3>

        <!-- Excerpt -->
        <p
            style="font-size: 0.95rem; color: var(--ardo-text-muted); line-height: 1.6; margin-bottom: 1.5rem; flex-grow: 1;">
            <?php echo htmlspecialchars($post['excerpt']); ?>
        </p>

        <!-- Tags / Features List -->
        <?php if (!empty($tags)): ?>
            <ul
                style="list-style: none; padding: 0; margin: 0 0 1.5rem; font-size: 0.85rem; color: var(--ardo-text-muted);">
                <?php foreach ($tags as $tag): ?>
                    <li style="margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="lni lni-tag" style="color: var(--ardo-primary); font-size: 0.8rem;"></i>
                        <?php echo htmlspecialchars($tag); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <!-- Footer / Link -->
        <div style="margin-top: auto;">
            <a href="<?php echo $baseUrl . $post['slug']; ?>" class="btn-dark"
                style="width: 100%; text-align: center; display: block; text-decoration: none;">
                Ver Más
            </a>
        </div>
    </div>
</div>