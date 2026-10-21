## Two running lengths

1. `x > 0`: `pos += 1`; `neg = neg + 1 if neg else 0`.
2. `x < 0`: `pos, neg = (neg + 1 if neg else 0), pos + 1`.
3. `x == 0`: `pos = neg = 0`. Track `max(pos)`.

`[1,-2,-3,4]` → 4. `[0,1,-2,-3,-4]` → 3. `[-1,-2,-3,0,1]` → 2.

Do not multiply values; products overflow. Only signs matter.

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
