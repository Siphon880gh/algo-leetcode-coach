## Example first

nums = [1, 2, 1, 2, 1].

1. No neighbours are equal yet.
2. The four neighbour pairs are (1, 2), (2, 1), (1, 2), (2, 1). As unordered pairs they are all {1, 2}.
3. Replace every 1 with 2: [2, 2, 2, 2, 2]. All 4 pairs are equal. Answer 4.

## Idea

1. A pair that is already equal holds one value twice, so it changes together and stays equal.
2. Replacing x with y only creates new equal pairs where neighbours hold exactly x and y.
3. So the answer is (equal pairs) + (the largest count of one unordered unequal pair), or + 0 if there is none.

## Steps

1. Walk the neighbour pairs.
2. If equal, add 1 to eq.
3. Otherwise add 1 to count[(min, max)].
4. Return eq + max(count), with max of nothing = 0.

## Trap

Counting ordered pairs. (1, 2) and (2, 1) are the same fix, so ordered counting gives 2 instead of 4 on Example 2. Fix: key by (min, max).

Checked: the examples give 2, 4 and 2, and the count matched trying every replacement on 300 random arrays.

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
