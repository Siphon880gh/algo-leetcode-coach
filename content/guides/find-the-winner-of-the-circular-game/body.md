## J(i) = (J(i − 1) + k) mod i

1. `r = 0` (one friend: position 0).
2. For `i = 2 … n`: `r = (r + k) % i`.
3. Return `r + 1`.

`n = 5, k = 2` → 3. `n = 6, k = 5` → 1.

After the first removal, the circle restarts just past the loser; shifting by `k` maps the smaller game's answer back. This meets the follow-up: O(n) time, O(1) space. A queue simulation is O(n · k) and also fine here.

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
