## Walk up to the root

Position `k` (1-indexed) in row `n` is a child of position `(k + 1) // 2` in row `n − 1`. The first child copies its parent; the second child is the flipped value.

Recursively: `f(n, k) = f(n − 1, (k + 1) // 2)` if `k` is odd, else `1 − f(n − 1, k / 2)`, with `f(1, 1) = 0`.

Unrolling it: the 0-indexed position `k − 1` written in binary describes the path from the root, where each 1 bit means "second child", which is a flip. So the answer is `popcount(k − 1) % 2`, and `n` does not matter.

Do not build the rows; row 30 has 2²⁹ symbols. Do not mix 1-indexed and 0-indexed positions; use `k − 1` for the bit trick.

Time: O(log k)  
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
