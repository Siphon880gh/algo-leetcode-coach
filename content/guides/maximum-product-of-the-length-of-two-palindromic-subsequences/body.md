## All palindromic masks

1. For each mask `m` in `1 … 2^n − 1`: build the subsequence; if it is a palindrome, store `pal[m] = popcount(m)`.
2. For every pair of stored masks with `a & b == 0`, `best = max(best, pal[a] · pal[b])`.

Examples → 9, 1, 25.

At most 4096 masks, so the pair loop is about 1.7 · 10^7 checks. A faster variant: for each palindromic mask `a`, take the longest palindromic subsequence (interval DP) of the characters outside `a`.

Time: O(4^n) worst case (O(2^n · n²) with the LPS variant)  
Space: O(2^n)

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
