## Example first

s = "kkk".

1. Split after index 0. Left: "k" (1 distinct). Right: "k" and "kk" (1 distinct each). 1 · 2 = 2 pairs.
2. Split after index 1. Left: "k" and "kk". Right: "k". 2 · 1 = 2 pairs.

Answer 4.

## Steps

1. For each split j from 0 to n − 2:
2. Walk i from j down to 0, track the letters of s[i … j], and add 1 to cnt[distinct].
3. Walk k from j + 1 up, track the letters of s[j + 1 … k], and add cnt[distinct] to the answer.

Each split costs O(n), and n ≤ 2000.

## Trap

Pairing only substrings of equal length. "k" and "kk" both have 1 distinct letter, so they pair. Equal lengths only gives 2 instead of 4 for Example 2. Fix: compare distinct counts, not lengths.

Checked: the examples give 2, 4 and 7, and the buckets matched checking every triple on 300 random strings.

Time: O(n²)  
Space: O(1) with 27 buckets

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
