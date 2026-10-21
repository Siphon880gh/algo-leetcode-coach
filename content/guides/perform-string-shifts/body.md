Given a string and a list of shifts, each a direction (left or right, encoded as in the statement) and an amount, apply all shifts and return the final string. For instance, `"abc"` shifted left 1 then right 2 gives `"cab"`. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Sum, then rotate

1. `net = Σ (right ? +amount : −amount)`.
2. `r = net mod n` (non-negative).
3. Return `s[n − r:] + s[:n − r]` (right rotation by `r`).

`"abc"`, left 1 then right 2 → net right 1 → `"cab"`.

Do not rotate once per shift; amounts can be large. Do not forget a negative net needs a non-negative modulo.

Time: O(n + shifts)  
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
