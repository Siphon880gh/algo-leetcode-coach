## Jump and turn around

1. Use a stack to build `pair[i]` for every parenthesis.
2. `i = 0`, `d = 1`. While `i < n`: if `s[i]` is a parenthesis, `i = pair[i]` and `d = −d`; else output `s[i]`. Then `i += d`.

`"(u(love)i)"` → `"iloveu"`. `"(ed(et(oc))el)"` → `"leetcode"`.

A simpler stack method reverses the buffer at each `)`; it is O(n²) but fine for n ≤ 2000.

Do not output the parentheses. Do not reverse only the innermost pair; every pair reverses its contents.

Time: O(n)  
Space: O(n)

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
