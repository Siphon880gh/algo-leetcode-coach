Pistons sit between 0 and a maximum height. Each second every piston moves one unit in its direction and reverses when it reaches an end. The area is the sum of their positions. Return the largest area reached at any time. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Sweep turn events

This assumes no piston starts at an end while pointing past it.

1. slope = #up − #down; area = Σ positions.
2. Up at p: slope −2 at time H − p, +2 at 2H − p. Down at p: +2 at time p, −2 at p + H.
3. Sweep event times up to 2H: area += slope · gap, record the maximum, then apply the event.

Constructed checks (run in code): height 5, [2, 5], UD → 7; height 6, [0, 0, 6, 3], UUDU → 15. Checked against second-by-second simulation on 400 random cases.

Returning the starting area: the second check → 9 instead of 15.

Time: O(n log n)  
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
