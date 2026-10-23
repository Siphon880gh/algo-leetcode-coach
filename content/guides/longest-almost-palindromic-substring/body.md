## Expand around centers

1. best = 2.
2. For each of the 2n − 1 centers: expand while s[l] = s[r]. The palindrome has length p = r − l − 1; best = max(best, min(n, p + 1)).
3. If both l and r are in range, try skipping s[l] (expand from l − 1, r) and skipping s[r] (expand from l, r + 1); best = max(best, final r − l − 1).
4. Return best.

Examples → 4, 4, 5. Checked against trying every substring and removal on 3,000 random strings.

Longest palindrome plus one: example 1 → 2 instead of 4.

Time: O(n²)  
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
