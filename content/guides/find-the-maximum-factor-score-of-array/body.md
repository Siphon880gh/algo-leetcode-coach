## Every removal

1. Prefix and suffix GCD and LCM.
2. Removing i: gcd(pg[i − 1], sg[i + 1]) · lcm(pl[i − 1], sl[i + 1]); also score the whole array.
3. Answer the maximum.

Examples → 64, 60, 9.

Never removing anything: example 1 → 32 instead of 64. The LCM of 1 … 30 is 2,329,089,562,800, so use 64-bit.

Time: O(n log V)  
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
