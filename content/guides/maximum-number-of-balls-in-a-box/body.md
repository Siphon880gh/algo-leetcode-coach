## Bucket by digit sum

1. `cnt = [0] * 46` (digit sums are at most 9 · 5 = 45 for numbers below 10^5, and 100000 sums to 1).
2. For each ball, add one to `cnt[digitsum(ball)]`.
3. Return `max(cnt)`.

`(1, 10)` → 2. `(5, 15)` → 2. `(19, 28)` → 2.

Do not index the count by the ball number itself.

Time: O(n · digits)  
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
