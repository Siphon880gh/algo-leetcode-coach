## Cursor and end

1. `pages = [homepage]`, `cur = 0`, `end = 0`.
2. `visit(url)`: `cur += 1`; write `url` at `cur` (append if needed); `end = cur`.
3. `back(s)`: `cur = max(0, cur − s)`. `forward(s)`: `cur = min(end, cur + s)`. Return `pages[cur]`.

In the statement's example, after visiting google, facebook, youtube, back(1) → facebook, back(1) → google, forward(1) → facebook; then visiting linkedin clears forward history.

Do not keep old forward pages reachable after a visit. Two stacks also work, at O(steps) per move.

Time: O(1) per call  
Space: O(visits)

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
