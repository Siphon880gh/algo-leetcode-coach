## Do the work in the constructor

Constructor:

1. `count = {}`, `lead = −1`.
2. For each vote `p` at time `times[i]`: `count[p] += 1`; if `lead == −1` or `count[p] ≥ count[lead]`, set `lead = p`. Store `leaders[i] = lead`.

`q(t)`: find the largest `i` with `times[i] ≤ t` (bisect right, minus one) and return `leaders[i]`.

Using `≥` makes the most recent vote win ties, as required.

Do not recount votes for every query; that is O(n) per query. Do not use `>`; a tie must go to the person who just got a vote.

Time: O(n) to build, O(log n) per query  
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
