## Splits instead of pairs

1. `cnt` = counter of `nums`.
2. For `i` in `1 … len(target) − 1`: `a = target[:i]`, `b = target[i:]`; add `cnt[a] · cnt[b]` if `a != b`, else `cnt[a] · (cnt[a] − 1)`.

Examples → 4, 2, 6. Checked against the double loop on random inputs.

Pairs are ordered (`(i, j)` and `(j, i)` both count), which the product already reflects. With n ≤ 100 the O(n² · L) double loop also passes.

Time: O(n · L + L²)  
Space: O(n · L)

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
