## Feasibility table

1. p[i] = 10^(digits of nums[i]) mod k.
2. ok(mask, r): true if mask is full and r = 0; otherwise any unused i with ok(mask | i, (r · p[i] + nums[i]) mod k).
3. If ok(0, 0) is false, return [].
4. Otherwise, at each position take the smallest unused value whose move keeps ok true.

Examples → [3, 12, 45], [5, 10], []. Checked against trying every permutation on 300 random arrays.

Trying numbers in string order instead of numeric order: example 1 → [12, 3, 45] instead of [3, 12, 45].

Time: O(2^n · k · n)  
Space: O(2^n · k)

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
