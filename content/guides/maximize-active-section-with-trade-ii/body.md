## Blocks and a sparse table

1. List zero blocks of s; pair[i] = len[i] + len[i + 1]; build a sparse table on pair.
2. For [l, r]: f = first block meeting l, a = last block meeting r (binary search). If there are fewer than two, gain 0.
3. clip(i) = the block’s length inside [l, r]. If a = f + 1, gain = clip(f) + clip(a); otherwise gain = max(clip(f) + len[f + 1], len[a − 1] + clip(a), max pair[f + 1 … a − 2]).
4. Answer total ones in s + gain.

Examples → [1], [4, 3, 1, 1], [6, 7, 2], [4, 4, 2]. Checked against running the single-string trade on every substring of 500 random strings.

Counting only the ones inside the substring: example 2 → [4, 3, 1, 0] instead of [4, 3, 1, 1].

Time: O((n + q) log n)  
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
