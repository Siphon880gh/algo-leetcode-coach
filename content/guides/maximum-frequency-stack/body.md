## Stacks by frequency level

State: `freq[x]`, `group[f]` (a stack of values that reached count `f`), `maxf`.

`push(x)`:

1. `f = freq[x] + 1`; `freq[x] = f`.
2. Push `x` onto `group[f]`; `maxf = max(maxf, f)`.

`pop()`:

1. `x = group[maxf].pop()`; `freq[x] −= 1`.
2. If `group[maxf]` is now empty, `maxf −= 1`.
3. Return `x`.

A value with count 3 sits on stacks 1, 2 and 3 at once. Popping it from level 3 leaves its copies at lower levels in the right places, and each stack keeps push order, so ties go to the most recent.

`maxf` only drops by one at a time because the value just popped still sits on level `maxf − 1`.

Do not use a heap keyed by (count, time); it works in O(log n) but this is O(1). Do not remove the value from every level on pop.

Time: O(1) per operation  
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
