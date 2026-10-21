## Count, then search

`count(m) = m//a + m//b + m//c − m//lcm(a,b) − m//lcm(a,c) − m//lcm(b,c) + m//lcm(a,b,c)`.

1. `lo = 1`, `hi = 2 · 10⁹` (the answer is guaranteed in this range).
2. While `lo < hi`: `mid = (lo + hi) // 2`; if `count(mid) ≥ n`, `hi = mid`, else `lo = mid + 1`.
3. Return `lo`.

`n = 3, a = 2, b = 3, c = 5` → 4. `n = 5, a = 2, b = 11, c = 13` → 10.

Do not generate the numbers one by one; n can be 10⁹. Use 64-bit (or Python) integers for the LCMs; they can reach 10¹⁸.

Time: O(log(2 · 10⁹))  
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
