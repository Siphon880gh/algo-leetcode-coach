## Block skipping

1. h = half counts; mid = the odd letter, if any. If the total arrangements < k, return "".
2. For each position: try letters a … z with h[c] > 0; w = arrangements of the rest. If k > w, k −= w; else take c.
3. Answer half + mid + reverse(half).

Cap counts at k (any value above k behaves the same) to keep numbers small.

Examples → baab, "", abcba. Checked against listing every palindromic permutation on 200 random strings.

Counting completions as (letters left)! without dividing by repeats: caccac, k = 2 → "" instead of caccac.

Time: O(n · 26 · 26)  
Space: O(26)

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
