## Wrap-around window

1. `k == 0` → all zeros.
2. `k > 0`: `res[i] = Σ code[(i + j) % n]` for `j = 1 .. k`.
3. `k < 0`: `res[i] = Σ code[(i + j) % n]` for `j = k .. −1`.

`[5,7,1,4]`, 3 → `[12,10,16,13]`. `[1,2,3,4]`, 0 → `[0,0,0,0]`. `[2,4,9,3]`, −2 → `[12,5,6,13]`.

n ≤ 100 makes O(n · |k|) fine; a sliding window gives O(n). Build a new array; do not overwrite code while reading it.

Time: O(n · |k|)  
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
