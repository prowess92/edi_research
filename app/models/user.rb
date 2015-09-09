class User < ActiveRecord::Base
  # unencrypted password
  attr_accessor :password

  # validation
  validates_presence_of      :first_name
  validates_presence_of      :surname
  validates_presence_of      :phone
  validates_length_of        :email, :within => 3..40
  validates_length_of        :password, :within => 6..40,
                                        :if => :password_required?
  validates_confirmation_of  :password, :if => :password_required?

  # callbacks
  before_save :encrypt_password

  # encrypts given password using salt
  def self.encrypt(pass, salt)
    Digest::SHA1.hexdigest("--#{salt}--#{pass}--")
  end

  protected
  
  # authenticate by email/password
  def self.authenticate(email, pass)
    user = find_by_email(email)
    user && user.authenticated?(pass) ? user : nil
  end  

  # does the given password match the stored encrypted password
  def authenticated?(pass)
   encrypted_password == User.encrypt(pass, salt)
  end

  #before save - create salt, encrypt password
  def encrypt_password
    return if password.blank?
    if new_record?
     self.salt = Digest::SHA1.hexdigest("--#{Time.now}--#{email}--")
    end
    self.encrypted_password = User.encrypt(password, salt)
  end

  #no encrypted password yet OR password attribute is set
  def password_required?
    encrypted_password.blank? || !password.blank?
  end
end
