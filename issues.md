- TODO: work on noticing user if password have been successfully resetted

  - forgot-password.php must be filled before accessing the reset-password - otherwise it wont work properly

FIXME: the sender's email is not displaying but rather the recipient's address

TODO: feed code blocks to chatgpt for easy documentation

TODO: store all info in the sign up to session and only store them in db if otp is confirmed

signup

- sessions

if email is unique

- verify-otp
  - !success:
    - save sessions to db
  - !failed
    - don't save
