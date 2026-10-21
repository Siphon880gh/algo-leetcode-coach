## Outside counts must fit

1. `c` = counts of the whole string, `q = n / 4`. If every count is `q`, return 0.
2. For each `r`: `c[s[r]] −= 1` (it moves into the window). While every `c[x] ≤ q`: record `r − l + 1`, then `c[s[l]] += 1`, `l += 1`.
3. Return the best length.

`"QQWE"` → 1. `"QQQW"` → 2.

Do not count what the window contains; the condition is on what stays outside. Do not forget the already-balanced case; the window loop would never record 0.

Time: O(n)  
Space: O(1)

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
