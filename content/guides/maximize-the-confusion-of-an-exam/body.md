## Two passes, one window each

1. `f(ch)`: `l = 0`, `bad = 0`; for each `r`: if `s[r] != ch`, `bad += 1`; while `bad > k`, drop `s[l]`; `best = max(best, r − l + 1)`.
2. Return `max(f('T'), f('F'))`.

Examples → 4, 3, 5.

Changing a question to the target letter is the only useful change, so the window just counts the others. Same pattern as Max Consecutive Ones III (1004).

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
