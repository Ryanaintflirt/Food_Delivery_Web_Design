<?php
include "header.php";
?>
<style>
    
/*card style*/

.Card {
  padding: 2rem;
  max-width: 1400px;
  margin: 0 auto;
  width: 100%;
  box-sizing: border-box;
  
}

.Card-Category h1 {
  font-size: 36px;
  font-family: 'Times New Roman', Times, serif;
  font-weight: 400px;
  text-align: center;
  margin-top: 2rem;
  margin-bottom: 3rem;
}

.image-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 3rem;
}

.image-container {
  position: relative;
  overflow: hidden;
  border-radius: 10px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
  transition: transform 0.3s ease;
  width: 100%;
  aspect-ratio: 3 / 2;
}

.image-container:hover {
  transform: translateY(-5px);
}

.image-container img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transition: transform 0.3s ease;
}

.image-container:hover img {
  transform: scale(1.05);
}

.image-overlay {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
  color: white;
  padding: 1rem;
  transform: translateY(100%);
  transition: transform 0.3s ease;
}

.image-container:hover .image-overlay {
  transform: translateY(0);
}
.btn-Order {
  display: inline-block;
  padding: 14px 32px;
  text-decoration: none;
  background-color: #ff511c;
  color: #ffffff;
  border-radius: 6px;
  font-size: 1.1rem;
  font-weight: bold;
  transition: all 0.3s ease;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}
.order-btn-wrapper {
  display: flex;
  justify-content: center;
  margin: auto;
  margin-top:3rem;
  margin-bottom: 1px;
}

/* Testimonials Section Styles */
.testimonials-section {
    padding: 4rem 2rem;
    background-color: #f8f9fa;
    margin-top: 2rem;
}

.testimonials-title {
    text-align: center;
    font-size: 36px;
    font-family: 'Times New Roman', Times, serif;
    margin-bottom: 3rem;
    color: #333;
}

.testimonials-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    max-width: 1400px;
    margin: 0 auto;
}

.testimonial-card {
    background: white;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.testimonial-card:hover {
    transform: translateY(-5px);
}

.testimonial-content {
    font-size: 1.1rem;
    line-height: 1.6;
    color: #555;
    margin-bottom: 1.5rem;
    font-style: italic;
}

.testimonial-author {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.author-image {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
}

.author-info h4 {
    margin: 0;
    color: #333;
    font-size: 1.2rem;
}

.author-info p {
    margin: 0;
    color: #666;
    font-size: 0.9rem;
}

.rating {
    color: #ffd700;
    margin-top: 0.5rem;
}

@media (max-width: 768px) {
    .testimonials-grid {
        grid-template-columns: 1fr;
    }
}
</style>
<section class="Card">
        <div class="Card-Category">
            <h2 class="text-center"  style=" margin-top: 2rem;">Our Services</h2>
            <div class="image-grid">
                <div class="image-container">
                    <a href="Contact.php" class="contact"><img src="img/Services/FoodDelivery.jpg" alt="Nature"></a>
                        <div class="image-overlay">
                            <h3>Food Delivery</h3>
                            <p>Offer delivery to their home or office, with real-time tracking.</p>
                        </div>
                </div>
                <div class="image-container">
                    <a href="Contact.php" class="contact"><img src="img/Services/onlineService.jpg" alt="Nature"></a>
                        <div class="image-overlay">
                            <h3>Online Ordering</h3>
                            <p>Let customers browse the menu and place orders directly from your site.</p>
                        </div>
                </div>
                <div class="image-container">
                    <a href="Contact.php" class="contact"><img src="img/Services/tableReservation.jpg" alt="Nature"></a>
                    <img src="img/Services/tableReservation.jpg" alt="Nature">
                        <div class="image-overlay">
                            <h3>Table Reservation</h3>
                            <p>Allow users to book a table in advance, selecting date and time.</p>
                        </div>
                </div>
                <div class="image-container">
                    <a href="Contact.php" class="contact"><img src="img/Services/mealPlan.jpg" alt="Nature"></a>
                        <div class="image-overlay">
                            <h3>Meal Plans</h3>
                            <p>Personalized meal subscriptions based on dietary needs (e.g., Keto, Vegan, Gluten-Free).</p>
                        </div>
                </div>
                <div class="image-container">
                    <a href="Contact.php" class="contact"><img src="img/Services/loyalty.jpg" alt="Nature"></a>
                        <div class="image-overlay">
                            <h3>Loyalty</h3>
                            <p>Earn points for each order or visit and redeem them for discounts or gifts.</p>
                        </div>
                </div>
                <div class="image-container">
                    <a href="Contact.php" class="contact"><img src="img/Services/catering.jpg" alt="Nature"></a>
                        <div class="image-overlay">
                            <h3>Catering</h3>
                            <p>Provide catering for parties, weddings, and corporate events.</p>
                        </div>
                </div>
            </div>
            <div class="order-btn-wrapper">
                <a href="Contact.php"><h3 class="btn-Order">Contact Us</h3></a> 
            </div>
        </div>
    </section>

<section class="testimonials-section">
    <h2 class="testimonials-title">What Our Clients Say</h2>
    <div class="testimonials-grid">
        <div class="testimonial-card">
            <div class="testimonial-content">
                "The food delivery service is incredibly fast and reliable. Every order arrives hot and fresh. Their customer service is outstanding!"
            </div>
            <div class="testimonial-author">
                <img src="img/client1.jpg" alt="Sarah Johnson" class="author-image">
                <div class="author-info">
                    <h4>Sarah Johnson</h4>
                    <p>Regular Customer</p>
                    <div class="rating">★★★★★</div>
                </div>
            </div>
        </div>

        <div class="testimonial-card">
            <div class="testimonial-content">
                "The catering service for our company event was exceptional. The food was delicious and the presentation was professional. Highly recommended!"
            </div>
            <div class="testimonial-author">
                <img src="img/client2.jpg" alt="Michael Chen" class="author-image">
                <div class="author-info">
                    <h4>Michael Chen</h4>
                    <p>Corporate Client</p>
                    <div class="rating">★★★★★</div>
                </div>
            </div>
        </div>

        <div class="testimonial-card">
            <div class="testimonial-content">
                "I love their meal plans! The variety and quality of food is amazing. It's made healthy eating so much easier for me."
            </div>
            <div class="testimonial-author">
                <img src="img/client3.jpg" alt="Emma Davis" class="author-image">
                <div class="author-info">
                    <h4>Emma Davis</h4>
                    <p>Meal Plan Subscriber</p>
                    <div class="rating">★★★★★</div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include "footer.php";
?>