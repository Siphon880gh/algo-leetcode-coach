## Components decide everything

1. Union-find over `0..max(nums)`.
2. Factor each `x` (trial division or a smallest-prime-factor sieve); union `x` with each prime factor.
3. `s = sorted(nums)`; return true iff `find(nums[i]) == find(s[i])` for every `i`.

Examples → true, false, true. Checked against a BFS over swap states on small random arrays.

Within a connected component, swaps generate every permutation (adjacent transpositions along the chain), so a component can be sorted in place. A position must receive a value from its own component. Equal values are interchangeable, which is why comparing values, not indices, is enough.

Time: O(n √V α) with trial division, or O(V log log V + n log V) with a sieve  
Space: O(V)

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
