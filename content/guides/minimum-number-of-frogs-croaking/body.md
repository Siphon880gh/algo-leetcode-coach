## Stage counters

1. `c` → `active += 1`, `peak = max(peak, active)`.
2. `r, o, a` → move one frog from the previous letter; fail with −1 if none.
3. `k` → move from `a` and `active −= 1`.
4. At the end, return `peak` if `active == 0`, else −1.

`"croakcroak"` → 1. `"crcoakroak"` → 2. `"croakcrook"` → −1.

Do not count c's; one frog can croak many times. Do not forget the final check; unfinished croaks make the input invalid.

Time: O(n)  
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
