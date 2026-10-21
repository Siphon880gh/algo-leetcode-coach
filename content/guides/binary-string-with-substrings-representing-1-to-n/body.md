## Lower half comes free

The binary of `2i` is the binary of `i` followed by 0, so if `2i ≤ n` is in `s`, so is `i`.

1. If `n − n // 2 > len(s)`, return false: the numbers in `(n/2, n]` need that many different substrings, and `s` has too few of each length.
2. For `i` from `n // 2 + 1` to `n`: if `bin(i)` is not a substring of `s`, return false.
3. Return true.

Do not loop from 1 to `n`; `n` reaches 10⁹. Step 1 caps the work at `len(s)` checks.

Time: O(len(s)² · log n)  
Space: O(log n)

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
