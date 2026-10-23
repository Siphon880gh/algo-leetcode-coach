## Centers

1. Prefix sums P.
2. Manacher (odd and even centers), or binary search on the radius with rolling hashes.
3. Answer = max over centers of the sum of the longest palindrome there.

Examples → 20, 9, 18, 5, 1000. Checked against every subarray on 3,000 random arrays. Edge check: 10^5 values of 10^9 → 10^14 in 0.2 s, so use 64-bit integers.

Taking only the longest palindrome overall: constructed check (run in code) [1, 2, 1, 2, 1, 100, 5, 100] → 7 instead of 205.

Time: O(n)  
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
