## Complementary remainders

1. `c[((x % k) + k) % k] += 1`.
2. `c[0]` even; for `r` in 1..k−1: `c[r] == c[k − r]` (covers `r = k/2` needing an even count).

`[1,2,3,4,5,10,6,7,8,9]`, 5 → true. `[1,2,3,4,5,6]`, 7 → true; 10 → false.

Do not use raw `%` on negatives in languages where it returns a negative value.

Time: O(n + k)  
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
