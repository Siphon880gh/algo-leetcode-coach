`s` has length 1 to 1e5, each character `I` (next is larger) or `D` (next is smaller). Return the lexicographically smallest permutation of `1..n+1` (where `n = |s|`) that matches. `"I"` → `[1,2]`. `"DI"` → `[2,1,3]`. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Ascending, with D runs flipped

Begin with the smallest possible list, `[1, 2, …, n + 1]`. It already satisfies every `I`. A run of `k` consecutive `D`s at positions `i..i+k−1` needs `k + 1` decreasing values at positions `i..i+k`. Reversing exactly that block uses the same small numbers in decreasing order and leaves every other position alone. For `"IDDI"`: start `[1,2,3,4,5]`, the D run covers positions 1–2, reverse indexes 1..3 → `[1,4,3,2,5]`.

Stack version: push `1..n+1` one by one; whenever you see an `I` (or reach the end), pop everything onto the output. Pops come out reversed, which is the same flip.

Why smallest: any valid permutation must put at least `k + 1` values in decreasing order there, and the ascending base gives each position the smallest number it can have.

DI String Match (942) accepts any valid permutation of `0..n`, so a two-pointer low/high trick works there. Construct Smallest Number From DI String (2375) is the same idea with digits 1–9.

Do not reverse only the `D` positions — the block includes the element after the last `D`. Do not search all permutations.

Time: O(n)  
Space: O(1) besides the output

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
