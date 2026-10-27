## Best stones for the player to move

`suf[i]` = sum of `piles[i:]`. `f(i, M)` = most stones the player to move can collect from pile `i` on:

- If `i + 2M ≥ n`: return `suf[i]` (take everything).
- Else: `max over x in 1..2M of suf[i] − f(i + x, max(M, x))`.

Answer: `f(0, 1)` with memoization.

Whatever the opponent collects from the rest, the mover gets everything else, which is why it is `suf[i]` minus the opponent's best.

Do not simulate greedily taking the most stones; it can hand the opponent a better position. `M` never needs to exceed `n`, so the table is at most `n × n`.

Time: O(n³)  
Space: O(n²)

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
