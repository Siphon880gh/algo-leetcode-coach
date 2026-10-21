## The first position that can grow

1. Write the digits as a list `d` and record `last[x]`, the last index of each digit `x`.
2. For `i` from left to right: for `x` from 9 down to `d[i] + 1`: if `last[x] > i`, swap `d[i]` and `d[last[x]]` and return the number.
3. If nothing swaps, return the original number.

Changing the leftmost possible position gains the most. Using the **largest** larger digit, at its **last** occurrence, makes that position as big as possible while moving the smaller digit as far right as possible.

Do not swap with the first occurrence of the larger digit; `1993` → `9913` (swap with the last 9), not `9193`. Do not swap more than once; the problem allows one swap.

Time: O(digits · 10)  
Space: O(digits)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
