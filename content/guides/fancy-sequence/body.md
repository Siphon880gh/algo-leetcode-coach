## One global affine map

1. `addAll(inc)`: `a += inc`. `multAll(k)`: `m *= k`, `a *= k` (all mod 1e9+7).
2. `append(val)`: store `(val − a) · m^(p−2)` mod p (Fermat inverse; m is never 0 mod p since multipliers are 1 … 100).
3. `getIndex(i)`: −1 if out of range, else `(stored[i] · m + a)` mod p.

Example: append 2, addAll 3, append 7, multAll 2 → getIndex(0) = 10; then addAll 3, append 10, multAll 2 → 26, 34, 20.

Do not update every element per operation (O(n) each). Inverses cost O(log p) per append.

Time: O(log p) append, O(1) others  
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
