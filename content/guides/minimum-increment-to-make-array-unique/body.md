## Assign values in sorted order

Sort `nums`. `need = 0`, `moves = 0`. For each `x`:

- `need = max(need, x)`.
- `moves += need − x`.
- `need += 1`.

Return `moves`.

In sorted order, each number takes the smallest value that is both ≥ itself and unused, which is the cheapest choice and never blocks later numbers more than necessary.

A counting version avoids the sort: carry the extra copies of each value forward to the next value.

Do not increment duplicates one step at a time while checking a set; that can be O(n²). Do not sort descending; smaller numbers should claim the low values.

Time: O(n log n)  
Space: O(1) besides the sort

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
