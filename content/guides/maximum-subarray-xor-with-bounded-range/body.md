## Window plus trie

1. P[0] = 0 goes into the trie.
2. For each r: update the deques; while max − min > k, remove P[l] from the trie and l++.
3. best = max(best, the largest P[r + 1] ⊕ y over y in the trie). Insert P[r + 1].
4. Return best.

Examples → 7, 6. Checked against every subarray on 2,000 random arrays.

Ignoring the range limit: example 2 → 7 instead of 6.

Time: O(n · 15)  
Space: O(n · 15)

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
