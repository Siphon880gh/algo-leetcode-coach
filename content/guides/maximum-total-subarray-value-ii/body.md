## k pops

1. Build sparse tables for range max and range min.
2. Push (value(l, n − 1), l, n − 1) for every l.
3. Repeat k times: pop the largest, add its value, push (l, r − 1) if r > l.
4. Return the total.

Examples → 4, 12. Checked against sorting every subarray value on 2,000 random cases.

Reusing the best subarray k times (the rule of part I): [1, 3, 2], k = 3 → 6 instead of 5.

Time: O(n log n + k log n)  
Space: O(n log n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
