## Divide by as little as possible

`nums[0]` is always in the numerator and `nums[1]` is always in the denominator, whatever the parentheses. The best case puts every other number in the numerator, which `nums[0] / (nums[1] / nums[2] / … / nums[n − 1])` does: it equals `nums[0] · nums[2] · … · nums[n − 1] / nums[1]`. Since every number is at least 2, that is the maximum.

So: one number → `"a"`; two → `"a/b"`; more → `"a/(" + "/".join(rest) + ")"`.

Interval DP over min and max values also works for this size, but it is unnecessary.

Do not wrap two numbers as `"a/(b)"` — those parentheses are redundant. Do not nest more parentheses inside; `b/c/d` already divides left to right.

Time: O(n)  
Space: O(n) for the string

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
