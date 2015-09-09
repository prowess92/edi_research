class CreateLogins < ActiveRecord::Migration
  def self.up
    create_table :logins do |t|
      t.integer :user_id
      t.string :username
      t.string :password
      t.integer :question_id
      t.string :answer

      t.timestamps
    end
  end

  def self.down
    drop_table :logins
  end
end
