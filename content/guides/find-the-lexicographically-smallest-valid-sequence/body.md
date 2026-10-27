## Precompute, then pick early

1. From the right, greedily match word2’s tail; suf[i] = matched length using word1[i…].
2. j = 0; for i: if word1[i] = word2[j], take i; else if the change is unused and suf[i + 1] ≥ m − j − 1, take i and use it.
3. Return the picks if j reaches m, else [].

Examples → [0, 1, 2], [1, 2, 4], [], [0, 1]. Checked against every index set on 400 random cases.

Matching exactly with no change: example 1 → [] instead of [0, 1, 2].

Time: O(n)  
Space: O(n)

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
