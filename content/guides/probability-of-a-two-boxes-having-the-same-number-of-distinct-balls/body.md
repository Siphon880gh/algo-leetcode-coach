## Multinomial weighting

1. `f(i, c1, d1, d2)`: colours from `i` on; `c1` balls in box 1 so far; `d1`, `d2` distinct counts.
2. For `x` in 0..balls[i]: weight `C(balls[i], x)`; `d1 += x > 0`, `d2 += x < balls[i]`; prune when `c1 > total/2`.
3. At the end, count only when `c1 == total/2` and `d1 == d2`.
4. Answer = good / `C(total, total/2)`.

`[1,1]` → 1.0. `[2,1,1]` → 0.66667. `[1,2,1,2]` → 0.6.

Do not count colour splits without the binomial weights; balls of one colour are distinct in the shuffle. At most 8 colours with ≤ 6 balls each keeps the search tiny.

Time: O(7^k) worst case  
Space: O(k)

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
