<?php
/**
 * Evangiz Restaurant - UI Reusable Components Helper
 */

/**
 * Renders a premium style CTA button with clean hover micro-animations
 */
function render_button($text, $link, $variant = 'primary', $extra_classes = '') {
    $base_class = 'btn';
    $variant_class = 'btn-' . htmlspecialchars($variant);
    $href = htmlspecialchars($link);
    $label = htmlspecialchars($text);
    
    // We support double text wrapper for premium slide-up text animation effect
    return "
    <a href=\"{$href}\" class=\"{$base_class} {$variant_class} {$extra_classes}\">
        <span class=\"btn-text-wrapper\">
            <span class=\"btn-text-main\">{$label}</span>
            <span class=\"btn-text-hover\">{$label}</span>
        </span>
    </a>";
}

/**
 * Renders a food menu item with elegant dotted-line price connectors
 */
function render_food_item($name, $price, $description, $tags = []) {
    $item_name = htmlspecialchars($name);
    $item_price = number_format($price);
    $item_desc = htmlspecialchars($description);
    
    $tags_html = '';
    if (!empty($tags)) {
        $tags_html .= '<div class="menu-item-tags">';
        foreach ($tags as $tag) {
            $tags_html .= '<span class="badge badge-menu">' . htmlspecialchars($tag) . '</span>';
        }
        $tags_html .= '</div>';
    }
    
    return "
    <div class=\"menu-item-wrapper animate-scroll-reveal\">
        <div class=\"menu-item-header\">
            <h4 class=\"menu-item-name\">{$item_name}</h4>
            <span class=\"menu-item-leader\"></span>
            <span class=\"menu-item-price\">UGX {$item_price}</span>
        </div>
        <div class=\"menu-item-body\">
            <p class=\"menu-item-desc\">{$item_desc}</p>
            {$tags_html}
        </div>
    </div>";
}

/**
 * Renders an elegant services summary card
 */
function render_service_card($icon, $title, $description) {
    $card_title = htmlspecialchars($title);
    $card_desc = htmlspecialchars($description);
    
    // Icon can contain SVG string or font-awesome tag. We expect safe HTML SVGs
    return "
    <div class=\"service-card animate-scroll-reveal\">
        <div class=\"service-icon-box\">
            {$icon}
        </div>
        <h3 class=\"service-title\">{$card_title}</h3>
        <p class=\"service-desc\">{$card_desc}</p>
    </div>";
}

/**
 * Renders a premium blog post card with elegant typography
 */
function render_blog_card($post) {
    $title = htmlspecialchars($post['title']);
    $slug = htmlspecialchars($post['slug']);
    $excerpt = htmlspecialchars(mb_strimwidth(strip_tags($post['content']), 0, 120, '...'));
    $date = date('F d, Y', strtotime($post['created_at']));
    $image = !empty($post['image_path']) ? htmlspecialchars($post['image_path']) : 'image/blog/default.jpg';
    
    // Support running in subdirectory by generating correct link
    $base_url = dirname($_SERVER['SCRIPT_NAME']);
    $base_url = str_replace('\\', '/', $base_url);
    $link = ($base_url === '/' ? '' : $base_url) . '/blog/' . $slug;
    
    return "
    <article class=\"blog-card animate-scroll-reveal\">
        <div class=\"blog-card-img-container\">
            <img src=\"{$image}\" alt=\"{$title}\" loading=\"lazy\">
        </div>
        <div class=\"blog-card-content\">
            <time class=\"blog-card-date\">{$date}</time>
            <h3 class=\"blog-card-title\">{$title}</h3>
            <p class=\"blog-card-excerpt\">{$excerpt}</p>
            <a href=\"{$link}\" class=\"blog-card-link\">
                <span>Read More</span>
                <svg class=\"link-arrow\" width=\"16\" height=\"16\" viewBox=\"0 0 16 16\" fill=\"none\">
                    <path d=\"M6 12L10 8L6 4\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"/>
                </svg>
            </a>
        </div>
    </article>";
}

/**
 * Renders a standardized form input control
 */
function render_form_input($name, $label, $type = 'text', $placeholder = '', $required = false, $value = '') {
    $input_name = htmlspecialchars($name);
    $input_label = htmlspecialchars($label);
    $input_type = htmlspecialchars($type);
    $input_placeholder = htmlspecialchars($placeholder);
    $input_value = htmlspecialchars($value);
    $req_attr = $required ? 'required' : '';
    $req_star = $required ? ' <span class="required-star">*</span>' : '';
    
    return "
    <div class=\"form-group\">
        <label for=\"{$input_name}\" class=\"form-label\">{$input_label}{$req_star}</label>
        <input type=\"{$input_type}\" id=\"{$input_name}\" name=\"{$input_name}\" class=\"form-control\" placeholder=\"{$input_placeholder}\" value=\"{$input_value}\" {$req_attr}>
        <span class=\"form-error-msg\"></span>
    </div>";
}

/**
 * Renders a standardized form select option control
 */
function render_form_select($name, $label, $options = [], $required = false, $selected = '') {
    $select_name = htmlspecialchars($name);
    $select_label = htmlspecialchars($label);
    $req_attr = $required ? 'required' : '';
    $req_star = $required ? ' <span class="required-star">*</span>' : '';
    
    $options_html = '';
    foreach ($options as $val => $txt) {
        $opt_val = htmlspecialchars($val);
        $opt_txt = htmlspecialchars($txt);
        $sel_attr = ($val == $selected) ? 'selected' : '';
        $options_html .= "<option value=\"{$opt_val}\" {$sel_attr}>{$opt_txt}</option>";
    }
    
    return "
    <div class=\"form-group\">
        <label for=\"{$select_name}\" class=\"form-label\">{$select_label}{$req_star}</label>
        <select id=\"{$select_name}\" name=\"{$select_name}\" class=\"form-control form-select\" {$req_attr}>
            {$options_html}
        </select>
        <span class=\"form-error-msg\"></span>
    </div>";
}

/**
 * Renders a standardized form textarea control
 */
function render_form_textarea($name, $label, $placeholder = '', $required = false, $value = '') {
    $input_name = htmlspecialchars($name);
    $input_label = htmlspecialchars($label);
    $input_placeholder = htmlspecialchars($placeholder);
    $input_value = htmlspecialchars($value);
    $req_attr = $required ? 'required' : '';
    $req_star = $required ? ' <span class="required-star">*</span>' : '';
    
    return "
    <div class=\"form-group\">
        <label for=\"{$input_name}\" class=\"form-label\">{$input_label}{$req_star}</label>
        <textarea id=\"{$input_name}\" name=\"{$input_name}\" class=\"form-control form-textarea\" placeholder=\"{$input_placeholder}\" rows=\"5\" {$req_attr}>{$input_value}</textarea>
        <span class=\"form-error-msg\"></span>
    </div>";
}
?>
