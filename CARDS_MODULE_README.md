# Cards Module - Installation and Usage Guide

## 📋 Overview
Cards module allows users to draw one card per day over a 28-day period, starting from a specified date. Each card is revealed with an animation, and users can record their daily experiences.

## 🗄️ Database Setup

### Step 1: Run SQL Migration
Execute the SQL file to create the necessary database structure:

```bash
mysql -u your_username -p your_database < /home/admin/web/consultation.profesionalnaastrologija.com/public_html/sql/create_cards_table.sql
```

Or manually run the SQL commands in your database management tool.

### Step 2: Insert Module Record
Add the Cards module to the `moduli` table:

```sql
INSERT INTO moduli (id, type, template, icon, naziv) 
VALUES (17, 'cards', 'cards.tpl', '/img/vodica.png', 'Karte');
```

### Step 3: Assign Module to Consultation Types
For each consultation type that should have the cards module, add a record to `konsultacije_moduli`:

```sql
-- Example: Assign to consultation type 62
INSERT INTO konsultacije_moduli (konsultacija, modul, redosled) 
VALUES (62, 17, 10);
```

Replace `62` with your consultation type ID and `10` with the desired display order.

## 📁 Required Files

### Images Folder Structure
Ensure the following images exist in `/img/karte/`:
- `0.jpg` - Card back (shown for unopened cards)
- `1.jpg` through `100.jpg` - Individual card images
- `vrti.gif` - Animated GIF for card flip animation

### Icon
Place the module icon at `/img/vodica.png`

## 🎯 Usage

### For Administrators (CMS)

1. **Assign Start Date**: When editing a consultation in the CMS, set the `cards` field to the desired start date (format: YYYY-MM-DD)

2. **Module Assignment**: Ensure module ID 17 is assigned to the consultation type in `konsultacije_moduli` table

### For Users

1. **Access**: Users will see the cards module icon when viewing their consultation
2. **Opening**: Click the cards icon to reveal the 28-card grid (4 columns × 7 rows)
3. **Daily Card Drawing**:
   - Each card shows its date below the image
   - Cards are drawn automatically on their assigned date
   - The flip animation (`vrti.gif`) plays for 2 seconds when revealing a card
   - Once drawn, the specific card image (1-100.jpg) is displayed
4. **Recording Experience**:
   - For today's card, a textarea appears below the card
   - User can write their experience and click "Sačuvaj" (Save)
   - Past cards show saved experiences in read-only format
5. **Missed Days**: If a user doesn't log in on a specific day, that card remains unopened

## 🔧 Technical Details

### Card Drawing Logic
- Cards are automatically drawn when their date ≤ current date
- Each card draws a random number between 1-100
- Once drawn, the card number is permanently stored
- Drawing happens on first view of the module after the date arrives

### Data Storage
- **consultation_cards table**: Stores all card information
  - `consultation_id`: Links to specific consultation
  - `user_id`: Links to user
  - `day_number`: Day 1-28
  - `card_date`: Specific date for this card
  - `card_number`: Random 1-100 (NULL if not yet drawn)
  - `experience`: User's written experience
  - `drawn_at`: Timestamp when card was drawn

### AJAX Endpoints
- `/inc/ajax/draw_card.php`: Handles card drawing
- `/inc/ajax/save_card_experience.php`: Saves user experience

## 🎨 Customization

### Styling
All CSS is embedded in `cards.tpl`. Modify the `<style>` block to customize:
- Card dimensions
- Grid layout
- Colors and shadows
- Responsive breakpoints

### Animation Duration
To change the flip animation duration, modify the timeout in `cards.tpl`:

```javascript
setTimeout(function() {
    // ... card drawing logic
}, 2000); // Change 2000 to desired milliseconds
```

## 🐛 Troubleshooting

### Cards not appearing
1. Check that module ID 17 exists in `moduli` table
2. Verify module is assigned in `konsultacije_moduli`
3. Ensure `cards` date is set in the consultation record
4. Check that images exist in `/img/karte/` folder

### Cards not flipping
1. Verify `vrti.gif` exists and is a valid animated GIF
2. Check browser console for JavaScript errors
3. Ensure jQuery is loaded on the page

### Experience not saving
1. Check that AJAX endpoints have proper permissions (644)
2. Verify database user has UPDATE permissions
3. Check browser console for AJAX errors

## 📱 Responsive Design
The module is fully responsive:
- **Desktop**: 4 cards per row
- **Tablet** (≤768px): 2 cards per row
- **Mobile** (≤480px): 1 card per row

## 🔐 Security Features
- User authentication check in AJAX handlers
- User ID verification (users can only access their own cards)
- SQL injection protection via parameterized queries
- Card drawing only allowed on or after the assigned date
