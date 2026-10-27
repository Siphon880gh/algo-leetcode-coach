## Push the increment down on pop

1. `push(x)`: if not full, append `x` and `inc = 0`.
2. `pop()`: if empty, −1; else `a = inc[i]`, pass `inc[i − 1] += a` if `i > 0`, return `stack[i] + a`.
3. `increment(k, v)`: if non-empty, `inc[min(k, size) − 1] += v`.

Example → pops `2`, then `103, 202, 201, −1`.

Do not loop over the bottom k elements on every increment; that is O(k). Do not push past `maxSize`; extra pushes are ignored.

Time: O(1) per operation  
Space: O(maxSize)

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
