## DP

1. Process nodes from n − 1 down to 0 (parents have smaller labels).
2. skip[v] starts as [1 at 0]; take[v] as [1 at nums[v] mod k].
3. For each child c: skip[v] ⊗= skip[c] + take[c]; take[v] ⊗= skip[c], where ⊗ is convolution mod k.
4. Return skip[0][0] + take[0][0] − 1 (drop the empty set), mod 10^9 + 7.

Examples → 1, 2. Checked against every subset on 800 random trees.

Keeping the empty set: example 1 → 2 instead of 1.

Time: O(n · k²)  
Space: O(n · k)

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
