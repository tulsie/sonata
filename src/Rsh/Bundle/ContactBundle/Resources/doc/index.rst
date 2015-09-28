
- Create a new contact bundle <Vendor>/Bundle/ContactBundle for example with app/console generate:bundle

- Create your ContactType class in
src/<Vendor/ContactBundle/Form/ContactType.php


-change app/config.yml and add
mremi_contact:
    # Add the ContactType here
    contact_form_type:     <Vendor>\ContactBundle\Form\ContactType

    add your buildForm method
    add your getName method

@todo fix the abstracttype add it to fork