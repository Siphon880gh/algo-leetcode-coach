One table lists candidates’ skills with a proficiency, and another lists projects’ required skills with an importance. For each project, pick the best candidate who has every required skill, scoring each candidate by how their proficiencies compare with the importances, as the statement defines the score and tie-break. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Coverage, score, rank

This assumes the score is a base value plus a bonus for each skill above its importance minus a penalty for each skill below, with ties going to the lower candidate id; take the three constants from the official statement (shown as :base, :up and :down).

Using the column names the statement gives:

1. `need`: required skill count per project.
2. `s`: per project and candidate, `COUNT(*)` and `:base + :up * SUM(prof > imp) - :down * SUM(prof < imp)` from projects joined to candidates on skill.
3. Keep s.have = need.k; `ROW_NUMBER() OVER (PARTITION BY proj ORDER BY score DESC, cand)`; return rank 1.

Constructed check (run in SQLite with base 100, up 10, down 5): project 1 needs py 4 and sql 3, project 2 needs py 5; candidate 101 has py 5, sql 3; 102 has py 4, sql 4; 100 has only py 5 → (1, 101, 110), (2, 100, 100).

Dropping the coverage test lets candidate 100 win project 1 without sql.

Time: O(n log n)  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
