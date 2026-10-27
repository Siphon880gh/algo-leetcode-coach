## Six states

Track `f[a][l]` = number of valid records so far with `a` absences (0 or 1) that end in exactly `l` consecutive lates (0, 1, or 2). Start with `f[0][0] = 1`.

For each day, build `g` from `f`:

- `P`: `g[a][0] += f[a][l]` for all `l`.
- `L`: `g[a][l + 1] += f[a][l]` for `l < 2`.
- `A`: `g[1][0] += f[0][l]` for all `l`.

Take everything mod `1e9 + 7`. The answer is the sum of all six states after `n` days.

The transition is a fixed 6×6 matrix, so matrix exponentiation gives O(log n) for very large `n`.

Student Attendance Record I (551) checks a single record.

Do not let `A` reset the absence count, and do not forget that `A` and `P` both end a late streak. Do not take the mod only at the end — the counts overflow quickly.

Time: O(n) with 6 states  
Space: O(1)

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
