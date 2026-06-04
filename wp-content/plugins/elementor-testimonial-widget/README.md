# Testimonial Card — Elementor Widget

A lightweight custom Elementor widget that renders a styled testimonial card with full styling controls inside the Elementor editor.

---

## Requirements

- WordPress 5.8+
- Elementor (free) 3.0+
- PHP 7.4+

---

## Installation

1. Copy the `elementor-testimonial-widget/` folder into `/wp-content/plugins/`.
2. Go to **Plugins → Installed Plugins** and activate **Testimonial Card Widget**.
3. Open any page or post with Elementor.
4. Search for **"Testimonial"** in the widget panel — drag it onto the canvas.

---

## File structure

```
elementor-testimonial-widget/
├── testimonial-widget.php          ← Plugin bootstrap
├── assets/
│   └── testimonial-card.css        ← Front-end styles
└── widgets/
    └── class-testimonial-card-widget.php  ← Widget class
```

---

## Controls at a glance

### Content tab
| Section | Controls |
|---|---|
| Quote | Quote icon picker, testimonial textarea |
| Author | Photo (media), name, job title |
| Rating | Show/hide toggle, star count (1–5), star icon picker |

### Style tab
| Section | Controls |
|---|---|
| Card | Background color, padding, border radius, border, box shadow |
| Quote Icon | Color, size |
| Testimonial Text | Color, typography, bottom spacing |
| Author | Photo size, photo border radius, name color/typography, title color/typography |
| Rating Stars | Star color, size, gap |

---

## Extending the widget

**Add a new control** inside `register_controls()`:
```php
$this->add_control( 'my_control', [
    'label'   => __( 'Label', 'testimonial-widget' ),
    'type'    => Controls_Manager::TEXT,
    'default' => 'Default value',
] );
```

**Use it in render()**:
```php
$value = $this->get_settings_for_display( 'my_control' );
echo esc_html( $value );
```

Always mirror changes in `content_template()` for the JS live-preview.

---

## License
GPLv2 or later — same as WordPress.
