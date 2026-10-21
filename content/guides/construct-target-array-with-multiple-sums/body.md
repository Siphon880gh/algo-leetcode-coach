## Reverse with modulo

1. One element: true only if it is 1.
2. Max-heap of values; `total = Σ`.
3. Pop `m`; `rest = total − m`. If `m == 1` or `rest == 1`, return true.
4. If `rest == 0`, `m < rest`, or `m mod rest == 0`, return false.
5. `m = m mod rest`, `total = rest + m`, push `m`; repeat.

`[9,3,5]` → true. `[1,1,1,2]` → false. `[8,5]` → true.

Do not subtract one step at a time; `[1, 10⁹]` would take forever. Do not forget `rest == 1`; then any value can be reached.

Time: O(n + log(max) · log n)  
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
