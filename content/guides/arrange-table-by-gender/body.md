A table Genders records user_id and gender, where gender is female, other or male and the three appear equally often. Rearrange the rows so the genders alternate female, other, male, female, other, male and so on, with each gender’s users in ascending user_id order. For instance, female users 3, 7, 9, other users 1, 2, 6 and male users 4, 5, 8 → 3, 1, 4, 7, 2, 5, 9, 6, 8. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Rank, then a fixed gender order

Using the column names the statement gives:

1. `rk = ROW_NUMBER() OVER (PARTITION BY gender ORDER BY user_id)`.
2. `SELECT user_id, gender … ORDER BY rk, CASE gender WHEN 'female' THEN 0 WHEN 'other' THEN 1 ELSE 2 END`.

Constructed check (run in SQLite; the users described above): 3, 1, 4, 7, 2, 5, 9, 6, 8.

The CASE gives the required order; sorting gender alphabetically would give female, male, other. MySQL can also use `FIELD(gender, 'female', 'other', 'male')`.

Time: O(n log n)  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
