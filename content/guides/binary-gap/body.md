## Track the previous 1

`last = −1`, `best = 0`, `i = 0`. While `n > 0`:

- If `n & 1`: if `last ≥ 0`, `best = max(best, i − last)`; then `last = i`.
- `n >>= 1`, `i += 1`.

Return `best`.

The distance is between positions, so adjacent 1s give 1, not 0.

Do not count the zeros between 1s; the answer is the zero count plus 1. Do not include the leading or trailing zeros; a gap needs a 1 at both ends.

Time: O(log n)  
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
